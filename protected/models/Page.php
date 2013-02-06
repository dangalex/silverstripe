<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Page extends CFormModel {

    public $id = 0;
    public $pageName;
    public $isHomePage = 0;
    public $pageContent;
    public $__store_id;
    public function rules() {
        return array(
            // pageName is required
            array('pageName', 'required'),
        );
    }

    /**
     * Declares attribute labels.
     */
    public function attributeLabels() {
        return array(
            'pageName' => 'Page Name',
            'pageContent' => 'Page Content',
            'isHomePage' => 'Is Home Page',
        );
    }

}

?>
