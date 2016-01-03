<!DOCTYPE html>
<html>
    <?php
    include 'header.php';
    include 'functions.php';
    ?>
    <body>
        <div data-role="page" class="ui-responsive-panel">




            <?php
            include 'menu.php';
            ?>

            <style>
                .userform { padding:.8em 1.2em; }
                .userform h2 { color:#555; margin:0.3em 0 .8em 0; padding-bottom:.5em; border-bottom:1px solid rgba(0,0,0,.1); }
                .userform label { display:block; margin-top:1.2em; }
                .switch .ui-slider-switch { width: 6.5em !important }
                .ui-grid-a { margin-top:1em; padding-top:.8em; margin-top:1.4em; border-top:1px solid rgba(0,0,0,.1); }
            </style>

            <div data-role="content">
                <?php
            if ($_POST) {
                addElementAction(); 
                echo 'added';
            }
                ?> 

                <h2>Panel: Menu + form</h2>

                <p>This is a typical page that has two buttons in the header bar that open panels. The left button opens a left menu with the reveal display mode. The right button opens a form in a right overlay panel.</p>
                <form class="userform" name="saveElement" action="addElements.php" method="post">
                    <h2>Create new user</h2>
                    <label for="groupName">Group Name</label>
                    <input type="text" name="groupName" id="groupName" value="" data-clear-btn="true" data-mini="true">

                    <label for="mobile">Mobile</label>
                    <input type="text" name="mobile" id="mobile" value="" data-clear-btn="true" data-mini="true">

                    <label for="userName">User Name</label>
                    <input type="text" name="userName" id="userName" value="" data-clear-btn="true" data-mini="true">

                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" value="" data-clear-btn="true" data-mini="true">

                    <label for="email">Email</label>
                    <input type="email" name="email" id="status" value="" data-clear-btn="true" data-mini="true">

<!--                    <div class="switch">
                        <label for="status">Status</label>
                        <select name="status" id="slider" data-role="slider" data-mini="true">
                            <option value="off">Male</option>
                            <option value="on">Female</option>
                        </select>
                    </div>-->
<input type="hidden" name="actionFunction"
                    <div class="ui-grid-a">
                        <div class="ui-block-a"><a href="#" data-rel="close" data-role="button" data-theme="c" data-mini="true">Cancel</a></div>
                        <div class="ui-block-b"><input type="submit" name="addElement" id="addElement" value="save"></div>
                    </div>
                </form>
            </div><!-- /content -->
            <!-- panel content goes here -->
        </div><!-- /page -->
    </body>
</html>
