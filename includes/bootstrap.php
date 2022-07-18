<?php
if(file_exists(PROTOTYPRESSTHEME_PATH."/vendor/autoload.php")){
    include_once(PROTOTYPRESSTHEME_PATH."/vendor/autoload.php");
}

include_once(PROTOTYPRESSTHEME_PATH."/includes/helpers/simple_html_dom-1.9.1.php");

include_once(PROTOTYPRESSTHEME_PATH."/includes/core/Block.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/core/Core.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/core/Menu.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/core/OptionsPage.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/core/Render.php");

include_once(PROTOTYPRESSTHEME_PATH."/includes/callbacks/RestApi.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/callbacks/Shortcodes.php");

include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/AdminAssets.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Assets.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Blocks.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/CustomActions.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/CustomFilters.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Fields.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/OptionsPages.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/PostTypes.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/RestApi.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Shortcodes.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Sidebars.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Taxonomies.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Widgets.php");

include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Actions.php");
include_once(PROTOTYPRESSTHEME_PATH."/includes/providers/Filters.php");

include_once(PROTOTYPRESSTHEME_PATH."/includes/Main.php");
