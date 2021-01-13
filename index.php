<?php
require_once("includes/header.php");
require_once("includes/classes/Sanitizer.php");
require_once("includes/classes/Constants.php");
require_once("includes/classes/Insert.php");

$insert = new Insert($con);

if (isset($_POST['submitButton'])) {
    $name = Sanitizer::sanitizeString($_POST["name"]);
    $age = Sanitizer::sanitizeString($_POST["age"]);
    $sex = Sanitizer::sanitizeString($_POST["sex"]);
    $property = Sanitizer::sanitizeArray($_POST['property']);
    $comment = Sanitizer::sanitizeString($_POST["comment"]);
    $success = $insert->validateAll($name, $age, $sex, $property, $comment);

    if ($success) {
        $_SESSION["isAnswered"] = true;
        header("Location: thanks.php");
    }
}

function checkInputValue($input)
{
    if (isset($_POST[$input]) && $_POST[$input] !== "" || !isset($_POST['submitButton'])) {
        return true;
    } else {
        return false;
    }
}
function checkProperty($array, $prop)
{
    foreach ($array as $el) {
        if ($el !== $prop) {
            continue;
        } else {
            return true;
        }
        return false;
    }
}

?>
<header id="main-header" class="py-2 bg-primary text-white">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h1><i class="far fa-question-circle mr-2"></i> 回答ページ</h1>
            </div>
        </div>
    </div>
</header>
<div class="container my-4">
    <div class="card card-default mb-5">
        <div class="card-header">
            <p class="lead">以下の質問に答えてください。</p>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="name">氏名</label>
                        <?php echo $insert->getError(Constants::$nameChars); ?>
                    </div>
                    <input class="form-control form-control-lg <?php if (checkInputValue("name")) {
                                                                    echo '';
                                                                } else {
                                                                    echo 'is-invalid';
                                                                } ?>" id="name" type="text" name="name" placeholder="氏名" value="<?php if (checkInputValue("name")) {
                                                                                                                                    echo $name;
                                                                                                                                } ?>">
                </div>

                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="age">年齢</label>
                        <?php echo $insert->getError(Constants::$ageInt); ?>

                    </div>

                    <select class="form-control form-control-lg <?php if (checkInputValue("age")) {
                                                                    echo '';
                                                                } else {
                                                                    echo 'is-invalid';
                                                                } ?>" id="age" type="number" name="age">
                        <option value="">選択してください</option>
                        <option value="0" <?php
                                            if ($age === '0') {
                                                echo 'selected';
                                            }  ?>>20歳未満</option>
                        <option value="1" <?php
                                            if ($age === '1') {
                                                echo 'selected';
                                            }  ?>>20歳〜39歳</option>
                        <option value="2" <?php
                                            if ($age === '2') {
                                                echo 'selected';
                                            }  ?>>40歳〜59歳</option>
                        <option value="3" <?php
                                            if ($age === '3') {
                                                echo 'selected';
                                            }  ?>>60歳以上</option>
                    </select>
                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="sex">性別</label>
                        <?php echo $insert->getError(Constants::$sexInt); ?>
                    </div>

                    <div class="form-check my-2">

                        <input type="radio" class="form-check-input" name="sex" id="male" value="0" <?php if ($sex === '0') {
                                                                                                        echo 'checked';
                                                                                                    } ?>>
                        <label for="male" class="form-check-label h5">男性</label>
                    </div>
                    <div class="form-check my-2">
                        <input type="radio" class="form-check-input" name="sex" id="female" value="1" <?php if ($sex === '1') {
                                                                                                            echo 'checked';
                                                                                                        } ?>>
                        <label for="female" class="form-check-label h5">女性</label>
                    </div>

                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="property">希望物件</label>
                        <?php echo $insert->getError(Constants::$propInt); ?>
                    </div>
                    <div class="form-inline">
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="checkbox" name="property[]" id="property1" value="1" <?php if (checkProperty($property, '1')) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>

                            <label class="form-check-label h5" for="property1">新築一戸建て</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="checkbox" name="property[]" id="property2" value="2" <?php if (checkProperty($property, '2')) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label h5" for="property2">中古一戸建て</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="checkbox" name="property[]" id="property3" value="3" <?php if (checkProperty($property, '3')) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label h5" for="property3">マンション</label>
                        </div>
                        <div class="form-check mr-3">
                            <input class="form-check-input" type="checkbox" name="property[]" id="property4" value="4" <?php if (checkProperty($property, '4')) {
                                                                                                                            echo 'checked';
                                                                                                                        } ?>>
                            <label class="form-check-label h5" for="property4">土地</label>
                        </div>

                    </div>

                </div>
                <div class="form-group">
                    <div class="d-flex justify-content-between">
                        <label for="comment">その他ご要望</label>
                        <?php echo $insert->getError(Constants::$commentChars) ?>
                    </div>
                    <textarea class="form-control <?php if (checkInputValue("comment") && $comment !== '') {
                                                        echo '';
                                                    } else {
                                                        echo 'is-invalid';
                                                    } ?>" name="comment" id="comment" cols="30" rows="10"><?php if (checkInputValue("comment")) {
                                                                                                                echo $comment;
                                                                                                            } ?></textarea>
                </div>

                <button class="btn btn-primary btn-lg m-2" name="submitButton" type="submit">送信</button>
                <a href="/Exam" class="btn btn-lg btn-danger m-2">キャンセル</a>

            </form>
        </div>
    </div>
</div>