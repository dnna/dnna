<?php
class Cv_Action_Helper_ParseProfile extends Zend_Controller_Action_Helper_Abstract {
    public function direct($url) {
        $ch = $this->getCurl($url);
        curl_setopt($ch, CURLOPT_REFERER, 'http://www.dnna.gr/cv/index/start');
        $result = curl_exec($ch);
        curl_close($ch);

        include_once(APPLICATION_PATH . '/plugins/SimpleHTML.php');
        // Create DOM from URL or file
        $html = str_get_html($result);

        $values = array();
        $values['workexperience'] = $this->parseWorkExperience($html->find('div.experience'));
        $values['volunteering'] = $this->parseVolunteering($html->find('ul.volunteering li.experience'));
        $values['projects'] = $this->parseProjects($html->find('ul.projects li.project'));
        $values['education'] = $this->parseEducation($html->find('div.education'));
        $values['specialties'] = $this->parseSpecialties($html->find('div#profile-specialties', 0));
        return $values;
    }
    
    protected function parseWorkExperience($elements) {
        $values = array();
        foreach ($elements as $element) {
            $item = new Cv_Model_Position();
            $item->set_title(@$element->find('.title', 0)->plaintext);
            $item->set_company(@$element->find('.company-profile-public', 0)->plaintext);
            $item->set_startdate(@$element->find('.dtstart', 0)->title);
            $item->set_enddate(@$element->find('.dtend', 0)->title);
            $item->set_location(@$element->find('.location', 0)->plaintext);
            $item->set_content(@$element->find('.description', 0)->plaintext);
            $values[] = $item;
        }
        return $values;
    }
    
    protected function parseProjects($elements) {
        $values = array();
        foreach ($elements as $element) {
            $item = new Cv_Model_Project();
            $item->set_title(@$element->find('h3 a', 0)->plaintext);
            $url = array();
            parse_str(parse_url(@$element->find('h3 a', 0)->href, PHP_URL_QUERY), $url);
            $item->set_url($url['url']);
            $dates = explode(' to ', trim(@$element->find('.specifics li', 0)->plaintext));
            $item->set_startdate(date('Y-n-j', strtotime(trim($dates[0]))));
            $end = @$element->find('abbr', 1);
            if(trim(strtolower(trim($dates[1]))) !== 'present') {
                $item->set_enddate(date('Y-n-j', strtotime(trim($dates[1]))));
            }
            $item->set_content(@$element->find('p', 0)->plaintext);
            $values[] = $item;
        }
        return $values;
    }
    
    protected function parseVolunteering($elements) {
        $values = array();
        foreach ($elements as $element) {
            $item = new Cv_Model_Position();
            $item->set_title(@$element->find('.title', 0)->plaintext);
            $item->set_company(@$element->find('h5', 0)->plaintext);
            $item->set_startdate(@$element->find('abbr', 0)->title);
            $end = @$element->find('abbr', 1);
            if(trim(strtolower($end->plaintext)) !== 'present') {
                $item->set_enddate($end->title);
            }
            $item->set_content(@$element->find('.summary', 0)->plaintext);
            $values[] = $item;
        }
        return $values;
    }
    
    protected function parseEducation($elements) {
        $values = array();
        foreach ($elements as $element) {
            $item = new Cv_Model_Education();
            $item->set_title(@$element->find('.summary', 0)->plaintext);
            $item->set_degree(@$element->find('.degree', 0)->plaintext);
            $item->set_major(@$element->find('.major', 0)->plaintext);
            $item->set_startdate(@$element->find('.dtstart', 0)->title);
            $item->set_enddate(@$element->find('.dtend', 0)->title);
            $item->set_content(@$element->find('.desc', 0)->plaintext);
            $values[] = $item;
        }
        return $values;
    }
    
    protected function parseSpecialties($element) {
        $item = new Cv_Model_ItemBase();
        $item->set_content($element->find('p', 0)->plaintext);
        return $item;
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
        curl_setopt($ch, CURLOPT_COOKIEFILE, $cookie_file_path);
        curl_setopt($ch, CURLOPT_COOKIEJAR, $cookie_file_path);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        //curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        return $ch;
    }

}

?>