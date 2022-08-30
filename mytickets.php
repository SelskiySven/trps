<?php include("header.php");
include("frames/head.php"); ?>

<body>
    <?php include("frames/mainmenu.php"); ?>
    <div class="centred">
        <table class="table" cellspacing="0">
            <thead>
                <tr>
                    <th><?php echo $TRPS["lang"]["problem"] ?></th>
                    <th><?php echo $TRPS["lang"]["date"] ?></th>
                </tr>
            </thead>
            <tbody id="for_tickets">

            </tbody>
        </table>
    </div>
</body>
<script src="mytickets_script.js"></script>