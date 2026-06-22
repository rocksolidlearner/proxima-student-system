<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container" style="margin: 50px auto;">
  <img src="<?=base_url('assets/images/cranbrook-college-logo2.png')?>" style="float: left;width: 200px !important">
  <h3 style="width: 80%;text-align: center;">Cranbrook College</h3>
  <p style="text-align: center;">180C Cranbrook Road, Ilford, London IG1 4LX</p>
  <p style="text-align: center;">02033711123</p> 
  <hr>
  <h3 style="text-align: center;"><?=$title?></h3>        
  <table class="table table-bordered" style="width: 100% !important;border-collapse: collapse;border-spacing: 2px;border: 1px solid #dee2e6;">
    <thead>
    <tr>
        <th style="display: table-cell;font-weight: bold;padding: 0.75rem;border: 1px solid #dee2e6;text-align: inherit;">Roll No.</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.75rem;border: 1px solid #dee2e6;text-align: inherit;">Student</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.75rem;border: 1px solid #dee2e6;text-align: inherit;">Class</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.75rem;border: 1px solid #dee2e6;text-align: inherit;">Father</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.75rem;border: 1px solid #dee2e6;text-align: inherit;">Contact</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($students as $std) {?>
    <tr>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['roll_no'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['std_name'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['class_name']; ?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['father_name'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['phone'];?></td>
    </tr>
    <?php }?>
    </tbody>
  </table>
</div>

</body>
</html>
