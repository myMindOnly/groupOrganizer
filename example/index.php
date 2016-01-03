
<!DOCTYPE html>
<html>
    <?php
    include 'header.php';
    ?>
    <body>
        <div data-role="page" class="ui-responsive-panel">
            
            <?php
            include 'menu.php';
            ?>


            <div data-role="panel" data-position="right" data-position-fixed="false" data-display="overlay" id="add-form" data-theme="b">

                <form class="userform">
                    <h2>Create new user</h2>
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="status" value="" data-clear-btn="true" data-mini="true">

                    <label for="password">Password:</label>
                    <input type="password" name="password" id="password" value="" data-clear-btn="true" autocomplete="off" data-mini="true">

                    <div class="switch">
                        <label for="status">Status</label>
                        <select name="status" id="slider" data-role="slider" data-mini="true">
                            <option value="off">Inactive</option>
                            <option value="on">Active</option>
                        </select>
                    </div>

                    <div class="ui-grid-a">
                        <div class="ui-block-a"><a href="#" data-rel="close" data-role="button" data-theme="c" data-mini="true">Cancel</a></div>
                        <div class="ui-block-b"><a href="#" data-rel="close" data-role="button" data-theme="b" data-mini="true">Save</a></div>
                    </div>
                </form>

                <!-- panel content goes here -->
            </div><!-- /panel -->

        </div><!-- /page -->
    </body>
</html>
