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
  <h4 style="width: 80%;text-align: center;">Cranbrook College</h4>
  <p style="text-align: center;">180C Cranbrook Road, Ilford, London IG1 4LX</p>
  <p style="text-align: center;">02033711123</p> 
  <hr>
  <p style="text-align: center;"><?=$title?></p>        
  <table class="table table-bordered" style="width: 100% !important;border-collapse: collapse;border-spacing: 2px;border: 1px solid #dee2e6;">
    <thead>
    <tr>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;">Sr.</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;">Fee</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;">Amount</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;">Date</th>
        <th style="display: table-cell;font-weight: bold;padding: 0.55rem;border: 1px solid #dee2e6;text-align: inherit;">Receipt</th>
    </tr>
    </thead>
    <tbody>
    <?php if(!empty($students)){
      foreach ($students as $std) {?>
    <tr>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['id'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['amount'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['amount']; ?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['paid_date'];?></td>
      <td style="padding: 0.75rem;border: 1px solid #dee2e6"><?=$std['receipt'];?></td>
    </tr>
    <?php }}else{
      echo'<tr><td align="center" colspan="4">No record found </td></tr>';
    }?>
    </tbody>
  </table>
</div>

</body>
</html>
