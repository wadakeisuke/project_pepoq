<!DOCTYPE html>
<html lang="ja" ng-app="SbM_top">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no">
<title>de mo</title>
<link href="style/css/red.css" rel="stylesheet">
<script src="style/js/icheck.js"></script>
<script src="style/js/custom.min.js"></script>
<script src="style/js/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $('input').each(function(){
    var self = $(this),
      label = self.next(),
      label_text = label.text();

    label.remove();
    self.iCheck({
      checkboxClass: 'icheckbox_line-red',
      radioClass: 'iradio_line-red',
      insert: '<div class="icheck_line-icon"></div>' + label_text
    });
  });
});
</script>
<style>
/* iCheck plugin Line skin, red
----------------------------------- */
.icheckbox_line-red,
.iradio_line-red {
    position: relative;
    display: block;
    margin: 0;
    padding: 5px 15px 5px 38px;
    font-size: 13px;
    line-height: 17px;
    color: #fff;
    background: #e56c69;
    border: none;
    -webkit-border-radius: 3px;
    -moz-border-radius: 3px;
    border-radius: 3px;
    cursor: pointer;
}
    .icheckbox_line-red .icheck_line-icon,
    .iradio_line-red .icheck_line-icon {
        position: absolute;
        top: 50%;
        left: 13px;
        width: 13px;
        height: 11px;
        margin: -5px 0 0 0;
        padding: 0;
        overflow: hidden;
        background: url(line.png) no-repeat;
        border: none;
    }
    .icheckbox_line-red.hover,
    .icheckbox_line-red.checked.hover,
    .iradio_line-red.hover {
        background: #E98582;
    }
    .icheckbox_line-red.checked,
    .iradio_line-red.checked {
        background: #e56c69;
    }
        .icheckbox_line-red.checked .icheck_line-icon,
        .iradio_line-red.checked .icheck_line-icon {
            background-position: -15px 0;
        }
    .icheckbox_line-red.disabled,
    .iradio_line-red.disabled {
        background: #F7D3D2;
        cursor: default;
    }
        .icheckbox_line-red.disabled .icheck_line-icon,
        .iradio_line-red.disabled .icheck_line-icon {
            background-position: -30px 0;
        }
    .icheckbox_line-red.checked.disabled,
    .iradio_line-red.checked.disabled {
        background: #F7D3D2;
    }
        .icheckbox_line-red.checked.disabled .icheck_line-icon,
        .iradio_line-red.checked.disabled .icheck_line-icon {
            background-position: -45px 0;
        }

/* HiDPI support */
@media (-o-min-device-pixel-ratio: 5/4), (-webkit-min-device-pixel-ratio: 1.25), (min-resolution: 120dpi), (min-resolution: 1.25dppx) {
    .icheckbox_line-red .icheck_line-icon,
    .iradio_line-red .icheck_line-icon {
        background-image: url(line@2x.png);
        -webkit-background-size: 60px 13px;
        background-size: 60px 13px;
    }
}
</style>

</head>
<body>

  <ul class="list">
    <li>
      <input tabindex="1" type="checkbox" id="line-checkbox-1">
      <label for="line-checkbox-1">Checkbox 1</label>
    </li>
    <li>
      <input tabindex="2" type="checkbox" id="line-checkbox-2" checked>
      <label for="line-checkbox-2">Checkbox 2</label>
    </li>
    <li>
      <input tabindex="3" type="checkbox" id="line-checkbox-3" checked>
      <label for="line-checkbox-3">Checkbox 3</label>
    </li>
    <li>
      <input tabindex="4" type="checkbox" id="line-checkbox-4" checked>
      <label for="line-checkbox-4">Checkbox 4</label>
    </li>
    <li>
      <input tabindex="5" type="checkbox" id="line-checkbox-5" checked>
      <label for="line-checkbox-5">Checkbox 5</label>
    </li>
    <li>
      <input tabindex="6" type="checkbox" id="line-checkbox-6" checked>
      <label for="line-checkbox-6">Checkbox 6</label>
    </li>
    <li>
      <input tabindex="7" type="checkbox" id="line-checkbox-7" checked>
      <label for="line-checkbox-7">Checkbox 7</label>
    </li>
    <li>
      <input tabindex="8" type="checkbox" id="line-checkbox-8" checked>
      <label for="line-checkbox-8">Checkbox 8</label>
    </li>
    <li>
      <input tabindex="9" type="checkbox" id="line-checkbox-9" checked>
      <label for="line-checkbox-9">Checkbox 9</label>
    </li>

  </ul>
</body>
