<!DOCTYPE html>
<html lang="en">
<head>
  <title>Download</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="margin: 10px 0px;max-width: 100%!important">
  <img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" style="float: left;width: 200px !important">
  <h3 style="width: 80%;text-align: center;">Cranbrook College</h3>
  <p style="text-align: center;">180C Cranbrook Road, Ilford, London IG1 4LX</p>
  <p style="text-align: center;">02033711123</p> 
  <hr>
  <h4 style="text-align: center;"><?=$title?></h4>        
  <table class="table table-bordered" style="width: 100% !important;border-collapse: collapse;border-spacing: 2px;border: 1px solid #dee2e6;">
    <thead>
    <tr>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;font-size: x-small;">Sr.</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;font-size: x-small;">Student Name</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;font-size: x-small;">Total Marks</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;font-size: x-small;">%</th>
    </tr>
    </thead>
    <tbody>
    <?php $count=1; foreach ($marks as $std) {
      foreach ($std['std_marks'] as $m) {?>
    <tr>
      <td style="padding: 0.55rem;border: 1px solid #dee2e6;font-size: x-small;"><?=$count++;?></td>
      <td style="padding: 0.55rem;border: 1px solid #dee2e6;font-size: x-small;"><?=$m['std_name'];?></td>
      <td style="padding: 0.55rem;border: 1px solid #dee2e6;font-size: x-small;"><?=$std['total_marks']; ?></td>
      <td style="padding: 0.55rem;border: 1px solid #dee2e6;font-size: x-small;"><?=($m['marks']/$std['total_marks'])*100;?>%</td>
    </tr>
    <?php }}?>
    </tbody>
  </table>
</div>

</body>
</html>
