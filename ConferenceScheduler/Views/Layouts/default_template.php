<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?=$this->title?></title>
</head>
<body>
    <-- body, side - keys-->
    <?= $this->getLayoutData('body')?>
    <?= $this->getLayoutData('side')?>
</body>
</html>