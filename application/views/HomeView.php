<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>Logo Quiz</title>
	<?php echo $globalStyle; ?>
</head>
<body class="logoHome" onbeforeunload="ConfirmClose()">
    <main>
        <div class="row">
            <div class="col-sm-4 col-xs-0"></div>
            <div class="col-sm-4 col-xs-12 center-div">
                <ul class="list-inline user-start-screen">
                    <li>
                        <div class="form-group pmd-textfield pmd-textfield-floating-label">
                            <label for="userName" class="control-label">
                                Enter Username
                            </label>
                            <input type="text" id="userName" name="userName" class="form-control">
                        </div>
                    </li>
                    <li>
                        <button type="button" id="join-logo" class="btn pmd-btn-raised pmd-ripple-effect btn-primary">Join</button>
                    </li>
                </ul>
                <div class="list-inline hide user-join-game">
                    <span class="total-online-users"></span><br><br>
                    <button type="button" id="find-user" class="btn pmd-btn-raised pmd-ripple-effect btn-primary">Play Quiz</button>
                </div>
                <div class="playing-area hide">
                    <input type="hidden" id="gameId" value=""/>
                    <input type="hidden" id="logoAns" value=""/>
                    <span class="playing-timer">0</span>
                    <span class="playing-score hide">0</span>
                    <h3 class="other-username"></h3>
                    <img class="img-responsive text-center" src="" alt="Logo"/>
                    <br>
                    <ul class="list-inline">
                        <li>
                            <div id="ans-txt-field" class="form-group pmd-textfield">
                                <label for="logoAnswer" class="control-label">
                                    Logo Answer
                                </label>
                                <input type="text" value="" id="logoAnswer" class="form-control"/>
                            </div>
                        </li>
                        <li>
                            <button type="button" id="check-logo-ans" class="btn pmd-btn-raised pmd-ripple-effect btn-primary">Check</button>
                        </li>
                    </ul>
                </div>
                <div class="waiting-area hide">
                    <i class="glyphicon glyphicon-refresh my-spin"></i>
                    <br>
                    <h3>Searching For Online Players....</h3>
                </div>
            </div>
            <div class="col-sm-4 col-xs-0"></div>
        </div>
        <!-- Alerts -->
        <button type="button" data-duration="5000"  data-positionX="center" data-positionY="top" data-effect="fadeInUp" data-message="Oh snap! Change a few things up and try submitting again." data-type="error" class="btn pmd-ripple-effect btn-danger pmd-z-depth pmd-alert-toggle hide" id="error-alert"></button>
        <div class="progress hide">
            <div class="indeterminate"></div>
        </div>

        <!-- alert Modal-->
        <div tabindex="-1" class="modal fade" id="alert-dialog" style="display: none;" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="pmd-card-title-text common-pink-txt"></h2>
                    </div>
                    <div class="modal-body"></div>
                    <div class="pmd-modal-action text-right">
                        <button data-dismiss="modal"  class="btn pmd-ripple-effect btn-default bus-booking-btn" type="button">Close</button>
                    </div>
                </div>
            </div>
        </div>
        <button data-target="#alert-dialog" data-toggle="modal" id="alert-modal" class="btn pmd-ripple-effect btn-primary pmd-z-depth hide" type="button">Alert without title bar</button>
    </main>
</body>
<?php echo $globalJs; ?>

</html>