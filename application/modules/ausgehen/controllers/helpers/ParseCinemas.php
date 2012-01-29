<?php
class Ausgehen_Action_Helper_ParseCinemas extends Zend_Controller_Action_Helper_Abstract {
    protected $url;

    public function direct() {
        $this->url = 'http://www.athinorama.gr/cinema/data/wareas/?id=1000002';
        $ch = $this->getCurl($this->url);
        $result = curl_exec($ch);
        curl_close($ch);

        include_once(APPLICATION_PATH . '/plugins/SimpleHTML.php');
        // Create DOM from URL or file
        $html = str_get_html($result);

        $values = array();
        $values = $this->parseAthinorama($html->find('div.aithousa-details', 0));
        return $values;
    }
    
    protected function parseAthinorama(simple_html_dom_node $html) {
        $values = array();
        $countnodes = $html->find('table.list-generic-table');
        foreach ($countnodes as $i => $element) {
            /* @var $moviedetails simple_html_dom_node */
            $moviedetails = $html->find('table.list-generic-table', $i);
            /* @var $datedetails simple_html_dom_node */
            $datedetails = $html->find('div.aithousa-provoles', $i);

            $item = new Ausgehen_Model_MovieEvent();
            $item->set_movietitle(@$moviedetails->find('.bold-red-14', 0)->plaintext);
            $item->set_length($this->findLength(@$moviedetails->find('.norm-11', 0)->plaintext));
            $item->set_cinemaroom(@$datedetails->find('strong', 0)->plaintext);
            $item->set_startdates($this->findStartdates(@$datedetails->innertext()));
            $item->set_cinemaname(@$html->find('.red-20 a .red-20', 0)->plaintext);
            $item->set_cinemalink($this->findCinemaLink(@$html->find('.red-20 a', 0)->href));
            $item->set_cinemaaddress($this->findCinemaAddress(@$html->innertext()));
            $values[] = $item;
        }
        return $values;
    }

    protected function findLength($lengthstring) {
        $lengthstring = explode(' | ', $lengthstring);
        preg_match_all('!\d+!', $lengthstring[count($lengthstring) - 1], $length);
        return $length[0];
    }

    protected function findStartdates($viewsstring) {
        if(($pos = strpos($viewsstring, '<div')) !== false) {
            $viewsstring = substr($viewsstring, 0, $pos);
        }
        $viewsstring = explode('<br />', $viewsstring);
        if(isset($viewsstring[1])) {
            $viewsstring = $viewsstring[1];
        } else {
            $viewsstring = $viewsstring[0];
        }
        $viewsstring = explode(': ', $viewsstring);
        $times = explode('/ ', $viewsstring[1]);
        $days = array('Thursday', 'Friday', 'Saturday', 'Sunday', 'Monday', 'Tuesday', 'Wednesday');
        $startdates = array();
        foreach($days as $day) {
            foreach($times as $time) {
                if(($pos = strpos($time, ',')) !== false) {
                    $time = substr($time, 0, $pos);
                }
                $zenddate = new Zend_Date();
                $zenddate->setTimestamp(strtotime($day.' '.str_replace('.', ':', $time)));
                $startdates[$day][] = $zenddate;
            }
        }
        return $startdates;
    }

    protected function findCinemaAddress($fullstring) {
        $end = strpos($fullstring, '<br');
        $fullstring = substr($fullstring, 0, $end);
        $start = strrpos($fullstring, '</div>');
        $fullstring = substr($fullstring, $start + strlen('</div>') + 1);
        return $fullstring;
    }

    protected function findCinemaLink($path) {
        $parsedurl = parse_url($this->url);
        return $parsedurl['scheme'].'://'.$parsedurl['host'].$path;
    }

    protected function getCurl($url) {
        $agent = "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.4) Gecko/20030624 Netscape/7.1 (ax)";
        $cookie_file_path = "/home/dnna/public_html/cv/curlcookie";
        $headers = array(
            'Host' => 'www.linkedin.com',
            'User-Agent' => 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:9.0.1) Gecko/20100101 Firefox/9.0.1',
            'Accept' => 'text/html,application/xhtml+xml,application/xml;q=0.9,*/*;q=0.8',
            'Accept-Language' => 'en-us,en;q=0.5',
            'Accept-Encoding' => 'gzip, deflate',
            'Accept-Charset' => 'ISO-8859-7,utf-8;q=0.7,*;q=0.7',
            'Connection' => 'keep-alive',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        //curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
        //curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }
}

?>