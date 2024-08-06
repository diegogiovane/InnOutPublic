<?php
    function loadModel($modelName) {
        require_once(MODEL_PATH . "/$modelName.php");
    }

    function loadView($viewName, $params = array()) {
        if(count($params) > 0) {
            foreach($params as $key => $value) {
                if(strlen($key) > 0){
                    ${$key} = $value;
                }
            }
        }

        require_once(VIEW_PATH . "/$viewName.php");
    }

    function loadTemplateView($viewName, $params = array()) {
        $templateHeader = 'header';
        $templateLeft = 'left';
        $templateFooter = 'footer';
        
        if(count($params) > 0) {
            foreach($params as $key => $value) {
                if(strlen($key) > 0){
                    ${$key} = $value;
                }
            }
        }

        require_once(TEMPLATE_PATH . "/$templateHeader.php");
        require_once(TEMPLATE_PATH . "/$templateLeft.php");
        require_once(VIEW_PATH . "/$viewName.php");
        require_once(TEMPLATE_PATH . "/$templateFooter.php");
    }

    function renderTitle($title, $subtitle, $icon = null) {
        require_once(TEMPLATE_PATH . "/title.php");
    }
?>