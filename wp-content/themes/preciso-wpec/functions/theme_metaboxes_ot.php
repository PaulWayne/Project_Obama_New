<?php
/* 
 *	Metaboxes
 * 	---------------------------------------------------------------------------
 * 	@package	: Pixelart Themes Framework
 *	@author 	: Umair
 *	@version	: 2.0
 *	@link		: http://www.pixelartinc.com
 *	@copyright	: Copyright (c) 2013, http://www.pixelartinc.com
 *	--------------------------------------------------------------------------- */
 
 
add_action( 'admin_init', '_custom_meta_boxes' );

function _custom_meta_boxes() {


    $page_meta_box = array(
        'id'          => 'page_meta_box',
        'title'       => 'Page Options',
        'desc'        => '',
        'pages'       => array( 'page' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'       => 'Description',
                'id'          => 'page_desc',
                'type'        => 'textarea-simple',
                'rows'        => '3'
            )
        )
    );

    $services_meta_box = array(
        'id'          => 'services_meta_box',
        'title'       => 'Services Options',
        'desc'        => '',
        'pages'       => array( 'services' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'       => 'icons_textblock',
                'id'          => 'icons_textblock',
                'type'        => 'textblock',
                'desc'        => 'Enter a possible value from the given: glass, music, search, star, star-empty, heart, user, envelope, film, th, th-large, th-list, ok, remove, zoom-in, zoom-out, off, signal, cog, trash, home, file, time, road, download, upload, download-alt, inbox, play-circle, repeat, refresh, lock, list-alt, flag, headphones, volume-off, volume-off, volume-down, qrcode, barcode, tag, tags, book, bookmark, print, camera, font, bold, italic, text-height, text-width, align-left, align-right, align-center, align-justify, list, indent-left, indent-right, facetime-video, picture, pencil, map-marker, adjust, tint, edit, share, check, move, step-backward, fast-backward, backward, play, pause, stop, forward, fast-forward, step-forward, eject, chevron-left, chevron-right, plus-sign, minus-sign, remove-sign, ok-sign, question-sign, info-sign, remove-circle, screenshot, ok-circle, ban-circle, arrow-left, arrow-right, arrow-up, arrow-down, resize-full, share-alt, resize-small, plus, minus, asterisk, exclamation-sign, gift, leaf, fire, eye-open, eye-close, warning-sign, plane, calendar, rendom, comment, magnet, chevron-up, chevron-down, retweet, shopping-cart, folder-close, folder-open, resize-vertical, resize-horizontal, hdd, bullhorn, bell, certificate, thumbs-up, thumbs-down, hand-right, hand-left, hand-up, hand-down, circle-arrow-right, circle-arrow-left, circle-arrow-up, circle-arrow-down, globe, wrench, tasks, filter, briefcase, fullscreen'
            ),
            array(
                'label'       => 'Service Icon',
                'id'          => 'services_icon',
                'type'        => 'text',
                'desc'        => ''
            ),
            array(
                'label'       => 'Services Subtitle',
                'id'          => 'subtitle',
                'type'        => 'text',
                'desc'        => ''
            ),
        )
    );

    $team_meta_box = array(
        'id'          => 'team_meta_box',
        'title'       => 'Team Options',
        'desc'        => '',
        'pages'       => array( 'team' ),
        'context'     => 'normal',
        'priority'    => 'high',
        'fields'      => array(
            array(
                'label'       => 'Designation',
                'id'          => 'designation',
                'type'        => 'text',
                'desc'        => ''
            ),
            array(
                'label'       => 'Website URL',
                'id'          => 'link',
                'type'        => 'text',
                'desc'        => ''
            ),
            array(
                'label'       => 'Facebook Link',
                'id'          => 'fb',
                'type'        => 'text',
                'desc'        => 'Enter your facebook link here.'
            ),
            array(
                'label'       => 'Twitter Link',
                'id'          => 'tw',
                'type'        => 'text',
                'desc'        => 'Enter your twitter link here.'
            ),
            array(
                'label'       => 'Google Plus Link',
                'id'          => 'gp',
                'type'        => 'text',
                'desc'        => 'Enter your google plus link here.'
            ),
            array(
                'label'       => 'Pinterest Link',
                'id'          => 'pin',
                'type'        => 'text',
                'desc'        => 'Enter your pin link here.'
            ),
            array(
                'label'       => 'Skills',
                'id'          => 'skills',
                'type'        => 'list-item',
                'desc'        => 'Enter your Skills here.',
                'settings'    => array(
                    array(
                        'id'          => 'skill_value',
                        'label'       => 'Value',
                        'desc'        => 'Enter skills value here. e.g. 50',
                        'std'         => '',
                        'type'        => 'text',
                    )
                )
            )
        )
    );

    ot_register_meta_box($services_meta_box);
    ot_register_meta_box($page_meta_box);
    ot_register_meta_box($team_meta_box);

}