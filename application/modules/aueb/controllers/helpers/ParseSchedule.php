<?php
class Aueb_Action_Helper_ParseSchedule extends Zend_Controller_Action_Helper_Abstract {
    public function direct(simple_html_dom_node $table) {
        $entries = array();
        $hours = $table->find('tr');
        //array_splice($hours, 1);
        array_shift($hours);
        foreach($hours as $curHour) {
            foreach($curHour->find('.scheduletd') as $dayNum => $curDay) {
                $hourname = $curHour->find('.rowhead', 0);
                $hoursplitted = explode('-', $hourname->innertext);
                $innertds = $curDay->find('.innertd');
                foreach($innertds as $innertd) {
                    $entry = new Aueb_Model_Entry();
                    $innertd->find('div', 0)->outertext = ''; // Remove the pin
                    $entry->set_prof($innertd->find('.prof', 0)->innertext);
                    $innertd->find('.prof', 0)->outertext = ''; // Remove prof
                    $entry->set_comments($innertd->find('.comments', 0)->innertext);
                    $comments = $innertd->find('.comments', 0)->outertext;
                    $rest = explode('<br />', $innertd->innertext);
                    $entry->set_coursename($rest[0]);
                    $entry->set_room($rest[1]);
                    $this->setStartEnd($entry, $dayNum, $hoursplitted[0], $hoursplitted[1]);
                    array_push($entries, $entry);
                }
            }
        }
        return $entries;
    }
    
    protected function setStartEnd(Aueb_Model_Entry &$entry, $dayNum, $start, $end) {
        // 0 Δευτέρα, 4 Παρασκευή
        $days = array();
        $days[0] = 'Monday';
        $days[1] = 'Tuesday';
        $days[2] = 'Wednesday';
        $days[3] = 'Thursday';
        $days[4] = 'Friday';
        $entry->set_start(new DateTime($days[$dayNum].' this week '.$start.':00'));
        $entry->set_end(new DateTime($days[$dayNum].' this week '.$end.':00'));
    }
}

?>