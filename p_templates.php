<?php
include("include/p_header.php");
?>
<main>
    <div class="container">
        <p class="templates-1">
            Templates
        </p>
        <p class="templates-2">
            Click on <i class='fas fa-check-square' style="color: #00ADB5;"></i> symbol to add that template to your portfolio.
            <br>
            <div class="row">
                Also, for removing templates click on 
                <form action="config/update_viewmode.php" method="POST" style="display:inline; text-align: center;">
                <input type="hidden" name="viewmode" value="0">
                <input type="hidden" name="redirect" value="p_portfolio.php">
                <button type="submit" class="templates-remove templates-remove-hover" style="">Remove Template</button>
            </form>
            </div>
        </p>
    </div>
    <br><br>
    <div class="container templates-img-container">
        <div class="row">
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-1.pdf">
                    <img src="asset/templates/images/PF-1.png" alt="Template-1" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="1">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-2 templates-divider">.</div>
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-2.pdf">
                    <img src="asset/templates/images/PF-2.png" alt="Template-2" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="2">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-3.pdf">
                    <img src="asset/templates/images/PF-3.png" alt="Template-3" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="3">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-2 templates-divider">.</div>
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-4.pdf">
                    <img src="asset/templates/images/PF-4.png" alt="Template-4" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="4">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-5.pdf">
                    <img src="asset/templates/images/PF-5.png" alt="Template-5" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="5">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-2 templates-divider">.</div>
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-6.pdf">
                    <img src="asset/templates/images/PF-6.png" alt="Template-6" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="6">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
        </div>
        <br>
        <div class="row">
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-7.pdf">
                    <img src="asset/templates/images/PF-7.png" alt="Template-7" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="7">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
            <div class="col-sm-2 templates-divider">.</div>
            <div class="col-sm-5">
                <a href="asset/templates/pdf/PF-8.pdf">
                    <img src="asset/templates/images/PF-8.png" alt="Template-8" class="templates-img templates-img-hover">
                </a>
                <form action="config/update_viewmode.php" method="POST">
                    <input type="hidden" name="viewmode" value="8">
                    <input type="hidden" name="redirect" value="p_portfolio.php">
                    <button type="submit" style="background:none;border:none;">
                        <i class='fas fa-check-square templates-select-icon templates-select-icon-hover'></i>
                    </button>
                </form>
            </div>
        </div>
        <br>
    </div>
</main>
<?php
include("include/footer.php");
?>
