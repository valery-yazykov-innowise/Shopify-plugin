<link rel="stylesheet" href="assets/css/style.css">

<div class="container">
    <div class="box">
        <div class="center">
            <form action="action.php" method="post">
                <div class="input-popup">
                    <label for="show-popup">Enable userwerk integration</label>
                </div>
                <div class="popup">
                    <select name="show-popup" id="show-popup">
                        <option value="1" <?php if ($_SESSION['status'] == 1) { echo 'selected'; }?>
                        >
                            Yes
                        </option>
                        <option value="0" <?php if ($_SESSION['status'] == 0) { echo 'selected'; }?>
                        >
                            No
                        </option>
                    </select>
                </div>
                <div class="input-label">
                    <label for="input">Domain name for popup</label>
                </div>
                <div class="input">
                        <input type="text"
                               id="input"
                               class="input-text"
                               placeholder="domain"
                               name="url"
                               value="<?php if (!empty($_SESSION['url'])){ echo $_SESSION['url'];}?>"
                        >
                </div>
                <div class="submit-button">
                    <input type="submit" value="Save">
                </div>
            </form>
        </div>
    </div>
</div>
