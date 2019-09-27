<?php

/** ====== Get site settings ====== */
if(! function_exists('general_settings')) {
    function general_settings($key = null)
    {
       $data = (new \App\Caching\SiteSettings)->generalSettings();

       return $key ? $data[$key] : $data;
    }
}

if(! function_exists('additional_settings')) {
    function additional_settings($key = null)
    {
        $data =  (new \App\Caching\SiteSettings)->additionalSettings();

        return $key ? $data[$key] : $data;
    }
}

if(! function_exists('features')) {
    function features()
    {
        return json_decode( (new \App\Caching\SiteSettings)->features(), true);
    }
}

if(! function_exists('breadcrumbs')) {
    function breadcrumbs()
    {
        return "<!-- Breadcrumbs -->
                    <nav class=\"breadcrumbs\">
                        <ul>
                            <li><a href=\"landing-v3-help.html\">All sections</a></li>
                            <li><a href=\"landing-v3-help-category.html\">Welcome to our app</a></li>
                            <li>Getting started</li>
                        </ul>
                    </nav>
                    <!-- /Breadcrumbs -->";
    }
}
