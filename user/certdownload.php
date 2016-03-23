<?php

    require_once('../config.php');
    $cert_id = optional_param('cert', 0, PARAM_INT); 
    $course = optional_param('course', 0, PARAM_INT); 
    
    global $CFG, $SITE, $PAGE, $OUTPUT ,  $USER;  
  

    if (!$course = $DB->get_record('course', array('id'=>$course))) {
        print_error('invalidcourseid');
    }
    
    redirect_if_major_upgrade_required();

    $urlparams = array();
    $PAGE->set_url('/', $urlparams);
    $PAGE->set_course($SITE);

    $PAGE->set_cacheable(false);
  
    $PAGE->set_pagetype('site-index');
    $PAGE->set_docs_path('');
    $PAGE->set_pagelayout('courselist');  //elaine add /theme/essential/layout/mycourses.php for no navbar
    $PAGE->set_title($SITE->fullname);
    $PAGE->set_heading($SITE->fullname);

    echo $OUTPUT->header();
    echo $OUTPUT->heading(get_string('downloadcert', 'certificate'));
          
    if ($cert_id !=0 ) {
        echo html_writer::start_tag('div', array('class' => 'certificate','align' => 'left'));
        echo $OUTPUT->box_start('certificate_download generalbox boxwidthwide boxaligncenter');
            $certdata=array();
            $certdata['user'] = $USER->firstname.''.$USER->lastname;
            $certdata['applytime'] = strftime('%Y/%m/%d %H:%M:%S', time()); 
            $certdata['coursename'] = $course->fullname; 
            echo html_writer::start_tag('div', array('align' => 'center'));
                echo get_string('downloadcertnote1', 'certificate',$certdata);
                echo html_writer::start_tag('div', array('style' => 'color:red'));
                    echo get_string('downloadcertnote2', 'certificate',$certdata);  
                    $url = $CFG->wwwroot.'/mod/certificate/view.php';   
                    $sesskey=sesskey();
                    echo $OUTPUT->single_button(new moodle_url($url, array('sesskey' => $sesskey,'id' => $cert_id,'action' =>'get')), get_string('getcertificate','certificate'), 'get');
                echo html_writer::end_tag('div');
            echo html_writer::end_tag('div'); 
        echo $OUTPUT->box_end();
        echo html_writer::end_tag('div');  
    }

    echo $OUTPUT->footer();
 die; 
   
 ?>