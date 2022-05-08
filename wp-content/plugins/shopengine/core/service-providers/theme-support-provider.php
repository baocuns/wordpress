<?php

namespace ShopEngine\Core\Service_Providers;


use ShopEngine\Core\Theme_Support\Theme_Support;

class Theme_Support_Provider
{

    public function init()
    {
        add_action('wp_loaded', function () {
         //   do_action('shopEngine_active_templates', Theme_Support::get_active_templates());
        });
    }

}
