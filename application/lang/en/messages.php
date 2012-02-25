<?php
$view = Zend_Controller_Front::getInstance()->getParam('bootstrap')->getResource('view');
return array(
    'headlinemain' => 'Dimosthenis Nektarios Nikoudis Alessios',
    'headlinecv' => 'Dimosthenis Nikoudis - Curriculum Vitae',

    'mainpagedescr' => 'Personal website for Dimosthenis Nikoudis',
    'cvdescr' => 'Dimosthenis Nektarios Nikoudis Alessios - Curriculum Vitae',
    'softeng' => 'Software Engineer',

    // Main page stuff
    'home' => 'Home',
    'projects' => 'Projects',
    'contact' => 'Contact',
    'cv' => 'CV',
    'vard' => 'VCard',
    'gcodeprofile' => 'Google Code Profile',
    'dissertation' => 'Dissertation',
    
    // Summary
    //'summary' => "My name is Dimosthenis Nikoudis and I'm a young but experienced Software Engineer currently working in the Technological Educational Institute of Athens. I'm passionate about new technologies, a strong proponent of open-source software, and I like to participate in open communities such as the Athens Wireless Metropolitan Network.",
    'summary' => 'Personal web-site and development portfolio of Dimosthenis Nikoudis.',
    'contactsummary' => 'You can view my online résumé <a href="'.$view->url(array('module' => 'cv', 'controller' => 'index')).'">here</a>, or you can find me in one of the social networks listed below.',
    'projectssummary' => 'This page is under construction. In the meantime, you can find my projects in my <a href="http://www.linkedin.com/in/dimosthenisnikoudis">LinkedIn profile</a>.',
    
    // Contact
    'yourname' => 'Name',
    'youremail' => 'E-Mail',
    'yourmessage' => 'Message',
    'send' => 'Send',
    'messagesent' => 'Your message was successfully sent.',

    // Languages
    'en' => 'English',
    'el' => 'Ελληνικά',

    // CV Stuff
    'personalinfo' => 'Personal Details',
    'workexperience' => 'Work Experience',
    'volunteering' => 'Volunteering/Non-Paid Experience',
    'education' => 'Education',
    'technicalskills' => 'Technical Skills',
    'languages' => 'Languages',
    'references' => 'References',

    'name' => 'Dimosthenis-Nektarios Nikoudis-Alessios',
    'address' => 'Zakynthou 13 Panorama Voula, 16673 Athens',
    'phone' => '+30 210 965 73 29',
    'email' => 'dnna@dnna.gr',

    'classification' => 'Classification: ',
    'present' => 'Present',

    'greek' => 'Greek: Native',
    'english' => 'English: C2, Certificate of Proficiency in English',

    // Errors
    'pagenotfound' => 'Page not found'
);
?>