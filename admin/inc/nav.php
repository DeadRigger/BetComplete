<?php
/**
 * nav.php
 *
 * Author: pixelcave
 *
 * The sidebar of the page, contains the main search and navigation as well as some theme options
 *
 */
?>
<!-- Sidebar -->
<aside id="page-sidebar" class="collapse navbar-collapse navbar-main-collapse">
    <!-- Sidebar search -->
    <form id="sidebar-search" action="page_search_results.php" method="post">
        <div class="input-group">
            <input type="text" id="sidebar-search-term" name="sidebar-search-term" placeholder="Search..">
            <button><i class="fa fa-search"></i></button>
        </div>
    </form>
    <!-- END Sidebar search -->

    <!-- Primary Navigation -->
    <nav id="primary-nav">
        <?php if ($primary_nav) { ?>
        <ul>
            <?php foreach ($primary_nav as $key => $link) {
                // Get vital info of links
                $url = (isset($link['url']) && $link['url']) ? $link['url'] : '#';
                $active = (isset($link['url']) && ($template['active_page'] == $link['url'])) ? ' class="active"' : '';
                $icon = (isset($link['icon']) && $link['icon']) ? '<i class="' . $link['icon'] . '"></i>' : '';

                // Check if we need add the class active to the li element (only if a sublink is active)
                $li_active = '';

                if (isset($link['sub']) && $link['sub']) {
                    foreach ($link['sub'] as $sub_link) {
                        if (in_array($template['active_page'], $sub_link)) {
                            $li_active = ' class="active"';
                            break;
                        }
                    }
                }
            ?>
            <li<?php echo $li_active; ?>>
                <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $icon . $link['name']; ?></a>
                <?php if (isset($link['sub']) && $link['sub']) { ?>
                    <ul>
                        <?php foreach ($link['sub'] as $sub_link) {
                            // Get vital info of sublinks
                            $url = (isset($sub_link['url']) && $sub_link['url']) ? $sub_link['url'] : '#';
                            $active = (isset($sub_link['url']) && ($template['active_page'] == $sub_link['url'])) ? ' class="active"' : '';
                            $icon = (isset($sub_link['icon']) && $sub_link['icon']) ? '<i class="' . $sub_link['icon'] . '"></i>' : '';
                        ?>
                        <li>
                            <a href="<?php echo $url; ?>"<?php echo $active ?>><?php echo $icon . $sub_link['name']; ?></a>
                        </li>
                        <?php } ?>
                    </ul>
                <?php } ?>
            </li>
            <?php } ?>
        </ul>
        <?php } ?>
    </nav>
    <!-- END Primary Navigation -->

    <!-- Demo Theme Options -->
    <div id="theme-options" class="text-left visible-md visible-lg">
        <a href="javascript:void(0)" class="btn btn-theme-options"><i class="fa fa-cog"></i> Theme Options</a>
        <div id="theme-options-content">
            <h5>Color Themes</h5>
            <ul class="theme-colors clearfix">
                <li class="active">
                    <a href="javascript:void(0)" class="themed-background-default themed-border-default" data-theme="default" data-toggle="tooltip" title="Default"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-deepblue themed-border-deepblue" data-theme="css/themes/deepblue.css" data-toggle="tooltip" title="DeepBlue"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-deepwood themed-border-deepwood" data-theme="css/themes/deepwood.css" data-toggle="tooltip" title="DeepWood"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-deeppurple themed-border-deeppurple" data-theme="css/themes/deeppurple.css" data-toggle="tooltip" title="DeepPurple"></a>
                </li>
                <li>
                    <a href="javascript:void(0)" class="themed-background-deepgreen themed-border-deepgreen" data-theme="css/themes/deepgreen.css" data-toggle="tooltip" title="DeepGreen"></a>
                </li>
            </ul>
            <h5>Header</h5>
            <label id="topt-fixed-header-top" class="switch switch-success" data-toggle="tooltip" title="Top fixed header"><input type="checkbox"><span></span></label>
            <label id="topt-fixed-header-bottom" class="switch switch-success" data-toggle="tooltip" title="Bottom fixed header"><input type="checkbox"><span></span></label>
            <label id="topt-fixed-layout" class="switch switch-success" data-toggle="tooltip" title="Fixed layout (for large resolutions)"><input type="checkbox"><span></span></label>
        </div>
    </div>
    <!-- END Demo Theme Options -->
</aside>
<!-- END Sidebar -->
