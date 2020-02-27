<?php

function InputElement($icon, $placeholder, $name, $value)
{
$Element = "
 <div class=\"input-group mb-2\">
    <div class=\"input-group-prepend\">
        <div class=\"input-group-text bg-warning\">$icon</div>
    </div>
    <input type=\"text\" name='$name' value='$value' class=\"form-control\"
           id=\"inlineFormInputGroup\" autocomplete=\"off\"
           placeholder='$placeholder'>
</div>
";
    echo $Element;
}

function ButtonElement($id, $style, $text, $name, $attr)
{
    $Button = "
    <button name='$name' '$attr' class='$style' id='$id'>$text</button>
    ";
    echo $Button;
}