<?php
require_once("includes/header.php");
require_once("includes/classes/Sanitizer.php");

if (isset($_POST['submitButton'])) {
    $name = Sanitizer::sanitizeString($_POST["name"]);
    $age = Sanitizer::sanitizeString($_POST["age"]);
    $sex = Sanitizer::sanitizeString($_POST["sex"]);
    $property = $_POST['property'];
    // $property = Sanitizer::sanitizeString($_POST["property"]);
    $comment = Sanitizer::sanitizeString($_POST["comment"]);
}

function checkInputValue($input)
{
    if (isset($_POST[$input]) && $_POST[$input] !== "" || !isset($_POST['submitButton'])) {
        return true;
    } else {
        return false;
    }
}
echo "<pre>";
var_dump(checkInputValue("comment"));
echo "</pre>";
function checkProperty($array, $property)
{
    foreach ($array as $el) {
        if ($el !== $property) {
            continue;
        } else {
            return true;
        }
        return false;
    }
}

?>
<h1 class="text-center my-5">アンケート回答ページ</h1>

<div class="card card-default mb-5">
    <div class="card-header">
        <p class="lead">Please answer the Questions!</p>
    </div>
    <div class="card-body">
        <form method="POST">
            <div class="form-group">
                <label for="name">氏名</label>
                <input class="form-control form-control-lg <?php if (checkInputValue("name")) {
                                                                echo '';
                                                            } else {
                                                                echo 'is-invalid';
                                                            } ?>" id="name" type="text" name="name" placeholder="氏名" value="<?php if (checkInputValue("name")) {
                                                                                                                                echo $name;
                                                                                                                            } ?>">
                <small class="invalid-feedback">氏名が未入力です</small>
            </div>

            <div class="form-group">
                <label for="age">年齢</label>
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
                <small class="invalid-feedback">年齢が未入力です</small>

            </div>
            <div class="form-group">
                <label for="sex">性別</label>
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
                <?php if (!checkInputValue("sex")) {
                    echo '<small class="text-danger">性別が未入力です</small>';
                } ?>

            </div>
            <div class="form-group">
                <label for="property">希望物件</label>
                <div class="form-inline">
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="property[]" id="property1" value="0" <?php if (checkProperty($property, '0')) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>

                        <label class="form-check-label h5" for="property1">新築一戸建て</label>
                    </div>
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="property[]" id="property2" value="1" <?php if (checkProperty($property, '1')) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        <label class="form-check-label h5" for="property2">中古一戸建て</label>
                    </div>
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="property[]" id="property3" value="2" <?php if (checkProperty($property, '2')) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        <label class="form-check-label h5" for="property3">マンション</label>
                    </div>
                    <div class="form-check mr-3">
                        <input class="form-check-input" type="checkbox" name="property[]" id="property4" value="3" <?php if (checkProperty($property, '3')) {
                                                                                                                        echo 'checked';
                                                                                                                    } ?>>
                        <label class="form-check-label h5" for="property4">土地</label>
                    </div>

                </div>
                <?php if (!checkInputValue("property")) {
                    echo '<small class="text-danger">希望物件が未入力です</small>';
                } ?>
            </div>
            <div class="form-group">
                <label for="comment">その他ご要望</label>
                <textarea class="form-control <?php if (checkInputValue("comment") && $comment !== '') {
                                                    echo '';
                                                } else {
                                                    echo 'is-invalid';
                                                } ?>" name="comment" id="comment" cols="30" rows="10"><?php if (checkInputValue("comment")) {
                                                                                                            echo $comment;
                                                                                                        } ?></textarea>
                <small class="invalid-feedback">その他ご要望が未入力です</small>
            </div>

            <button class="btn btn-primary btn-lg m-2" name="submitButton" type="submit">送信</button>
            <a href="/Exam" class="btn btn-lg btn-danger m-2">キャンセル</a>

        </form>
    </div>
</div>