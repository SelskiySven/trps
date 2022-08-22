<span class="select">
    <div name="UI_LANG" class="selected" onclick="openselect(this)"><?php echo strtoupper($_COOKIE["UI_LANG"]); ?></div>
    <div class="select_options" id="language_options">
        <?php
        $dirs = scandir("lang");
        foreach ($dirs as $lang) {
            if ($lang != "." and $lang != "..") {
                echo '<div onclick="change_language(\''. $lang .'\')">' . strtoupper($lang) . '</div>';
            }
        }
        ?>
    </div>
</span>
<script>

    function change_language(lang) {
        let changelanguage = new XMLHttpRequest()
        changelanguage.open("GET", "scripts/changelanguage.php?ui=" + lang)
        changelanguage.onload = function() {
            document.location = document.location
        }
        changelanguage.send()
    }
</script>