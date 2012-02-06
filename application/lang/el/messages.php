<?php
$view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
return array(
    'headlinemain' => 'Δημοσθένης Νεκτάριος Νικούδης Αλέσσιος',
    'headlinecv' => 'Δημοσθένης Νικούδης - Βιογραφικό Σημείωμα',
    
    'mainpagedescr' => 'Προσωπική ιστοσελίδα του Δημοσθένη Νικούδη',
    'cvdescr' => 'Δημοσθένης Νεκτάριος Νικούδης Αλέσσιος - Βιογραφικό Σημείωμα',
    'softeng' => 'Μηχανικός Λογισμικού',

    // Main page stuff
    'home' => 'Αρχική',
    'projects' => 'Έργα',
    'contact' => 'Επικοινωνία',
    'cv' => 'CV',
    'vard' => 'VCard',
    'gcodeprofile' => 'Προφίλ Google Code',

    // Summary
    'summary' => "Ονομάζομαι Δημοσθένης Νικούδης και είμαι ένας νέος, αλλά έμπειρος, Μηχανικός Λογισμικού που δουλεύει αυτή τη στιγμή στο ΤΕΙ Αθήνας. Με ενθουσιάζουν οι νέες τεχνολογίες, είμαι υποστηρικτής του ανοικτού λογισμικού και μου αρέσει να συμμετέχω σε ανοικτές κοινότητες όπως το Ασύρματο Μητροπολιτικό Δίκτυο Αθηνών.",
    'contactsummary' => '
        Μπορείτε να δείτε το online βιογραφικό μου <a href="'.$view->url(array('module' => 'cv', 'controller' => 'index')).'">εδώ</a>, ή να με βρείτε σε κάποιο από τα κοινωνικά δίκτυα που παρατίθενται παρακάτω.',

    // Languages
    'en' => 'English',
    'el' => 'Ελληνικά',

    // CV Stuff
    'personalinfo' => 'Προσωπικές Πληροφορίες',
    'workexperience' => 'Εργασιακή Εμπειρία',
    'volunteering' => 'Εθελοντική/Μη Αμειβόμενη εμπειρία',
    'education' => 'Εκπαίδευση',
    'technicalskills' => 'Τεχνικές Γνώσεις',
    'languages' => 'Γλώσσες',
    'references' => 'Συστάσεις',

    'name' => 'Δημοσθένης-Νεκτάριος Νικούδης-Αλέσσιος',
    'address' => 'Ζακύνθου 13, Πανόραμα Βούλας, 16673 Αθήνα',
    'phone' => '+30 210 965 73 29',
    'email' => 'dnna@dnna.gr',

    'classification' => '',
    'present' => 'Παρόν',

    'greek' => 'Ελληνικά',
    'english' => 'Αγγλικά: Επίπεδο C2, Certificate of Proficiency in English',

    // Errors
    'pagenotfound' => 'Η σελίδα δεν βρέθηκε'
);
?>