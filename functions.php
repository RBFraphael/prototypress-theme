<?php

define("PROTOTYPRESSTHEME_URL", get_template_directory_uri());
define("PROTOTYPRESSTHEME_PATH", get_template_directory());
define("PROTOTYPRESSTHEME_VERSION", wp_get_theme()->get("Version"));
define("PROTOTYPRESSTHEME_TEXTDOMAIN", wp_get_theme()->get("TextDomain"));

include_once(PROTOTYPRESSTHEME_PATH."/includes/bootstrap.php");
\PrototyPressTheme\Main::Init();
