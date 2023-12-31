<?php
/**
 * Spacebar Portal Theme functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Spacebar Portal
 * @since 1.0.0
 */

/**
 * Define Constants
 */
define( 'CHILD_THEME_SPACEBAR_PORTAL_VERSION', '1.0.0' );

/**
 * Enqueue styles
 */

/*function prettyPrint($array) {
	echo '<pre>'.print_r($array, true).'</pre>';
}*/

function child_enqueue_styles() {

    wp_enqueue_style( 'material-ui-styles', 'https://unpkg.com/material-components-web@latest/dist/material-components-web.min.css');

    //include this as well for the icons
    //<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">

    wp_enqueue_script('material-ui-script', 'https://unpkg.com/material-components-web@latest/dist/material-components-web.min.js', '', false, true);

    wp_enqueue_script('my-scripts', get_stylesheet_directory_uri() . '/assets/my-scripts.js', '', false, true);


	wp_enqueue_style( 'spacebar-portal-theme-css', get_stylesheet_directory_uri() . '/style.css', array('astra-theme-css'), CHILD_THEME_SPACEBAR_PORTAL_VERSION, 'all' );

	/*$result = GFAPI::get_form(2);
	$la = GFAPI::duplicate_form( 2 );
	prettyPrint($la);*/

}

add_action( 'wp_enqueue_scripts', 'child_enqueue_styles', 30 );


/*
*
*

https://docs.gravityforms.com/gform_field_input/

PARAMETERS:

$input string
The input tag string to be filtered. Will be passed to the hook an empty string value. Return an empty string to bypass the filtering, or change its value to specify a new input tag.

$field Field Object

The field that this input tag applies to

$value string

The default/initial value that the field should be pre-populated with

$entry_id integer

When executed from the entry detail screen, $lead_id will be populated with the Entry ID. Otherwise, it will be 0

$form_id integer

The current Form ID.
*/

function modify_input_html($content, $field, $value, $lead_id, $form_id){ 

    $changed_content = $content;
    echo '<pre>';
    var_dump($field);
    echo '</pre>';
    
    if ( $field->cssClass == 'material-input' ) { //this class was set in the Gravity form settings > field settings >appearance > custom CSS
        //see Material UI for web implementation documentation. Documentation for the html below: https://m2.material.io/components/text-fields/web#outlined-text
        //Check out this field object. This is where we got the cssClass above. https://docs.gravityforms.com/field-object/

        $changed_content = '<label class="mdc-text-field mdc-text-field--filled">
          <span class="mdc-text-field__ripple"></span>
          <span class="mdc-floating-label" id="my-label-id">' . GFCommon::get_label( $field ) . '</span>
          <input class="mdc-text-field__input" type="text" aria-labelledby="my-label-id" value="">
          <span class="mdc-line-ripple"></span>
        </label>';
    }
    else if( $field->cssClass == 'material-radio' ){
        //create the element that the radio buttons are inside of.
        $changed_content = '<div class="mdc-form-field">';

        //https://www.php.net/manual/en/control-structures.foreach.php
        //foreach loop $field->choices
            //inside of it, append new string to changed_content with the correct values
        foreach ($field->choices as $value) {
            echo($value);

            $changed_content .= '<div class="mdc-touch-target-wrapper">
            <div class="mdc-radio mdc-radio--touch">
            <input class="mdc-radio__native-control" type="radio" id="radio-1" name="radios">
            <div class="mdc-radio__background">
              <div class="mdc-radio__outer-circle"></div>
              <div class="mdc-radio__inner-circle"></div>
            </div>
            <div class="mdc-radio__ripple"></div>
          </div>
          <label for="radio-1">  ' . $value['text'] . ' </label>'; //change out Radio 1
        }
        //endforeach

        $changed_content .= '</div>';
  //might also be =.


    }

    return $changed_content; //this is returning the html to the page
}



/*
https://developer.wordpress.org/reference/functions/add_filter/
*/

add_filter( 'gform_field_content', 'modify_input_html', 10, 5 );



/*add_filter( 'gform_field_content', 'subsection_field', 10, 5 );
function subsection_field( $content, $field, $value, $lead_id, $form_id ) {
  
    if ( $field->cssClass == 'subsection' ) {
        if ( RG_CURRENT_VIEW == 'entry' ) {
            $mode = empty( $_POST['screen_mode'] ) ? 'view' : $_POST['screen_mode'];
            if ( $mode == 'view' ) {
                $content = '<tr>
                                <td colspan="2" class="entry-view-section-break">'. esc_html( GFCommon::get_label( $field ) ) . '</td>
                            </tr>';
            } else {
  
                $content= "<tr valign='top'>
                        <td class='detail-view'>
                            <div style='margin-bottom:10px; border-bottom:1px dotted #ccc;'><h2 class='detail_gsection_title'>" . esc_html( GFCommon::get_label( $field ) ) . "</h2></div>
                        </td>
                    </tr>";
            }
        } else {
  
            $delete_field_link = "<a class='field_delete_icon' id='gfield_delete_{$field->id}' title='" . __( 'click to delete this field', 'gravityforms' ) . "' href='javascript:void(0);' onclick='StartDeleteField(this);'>" . __( 'Delete', 'gravityforms' ) . "</a>";
            $delete_field_link = apply_filters( 'gform_delete_field_link', $delete_field_link );
  
            //The edit and delete links need to be added to the content (if desired), when using this hook
            $admin_buttons = IS_ADMIN ? $delete_field_link . " <a class='field_edit_icon edit_icon_collapsed' title='" . __( 'click to edit this field', 'gravityforms' ) . "'>" . __( 'Edit', 'gravityforms' ) . "</a>" : "";
  
            $content = "{$admin_buttons}<h3 class='subsection_title'>" . $field->label . "</h3>";
        }
  
    }
    return $content;
}*/