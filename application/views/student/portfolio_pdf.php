<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Student ePortfolio</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            color: #222;
        }
        h1, h2, h3, p {
            margin: 0 0 8px 0;
        }
        .meta {
            margin-bottom: 18px;
            padding-bottom: 12px;
            border-bottom: 1px solid #ddd;
        }
        .summary-table {
            width: 100%;
            border-collapse: collapse;
            margin: 12px 0 18px 0;
        }
        .summary-table td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .entry {
            margin-bottom: 18px;
            padding: 12px;
            border: 1px solid #ddd;
        }
        .label {
            font-weight: bold;
            display: inline-block;
            min-width: 130px;
        }
        .small {
            color: #666;
            font-size: 11px;
        }
        .filters {
            margin-bottom: 12px;
            padding: 8px 10px;
            background: #f5f7fb;
            border: 1px solid #e1e7f0;
        }
    </style>
</head>
<body>
    <div class="meta">
        <h1>Student ePortfolio</h1>
        <h2><?=(isset($student['std_name']) ? $student['std_name'] : 'Student')?></h2>
        <p>Admission No: <?=(isset($student['admission_no']) ? $student['admission_no'] : '-')?></p>
        <p>Roll No: <?=(isset($student['roll_no']) ? $student['roll_no'] : '-')?></p>
        <p class="small">Generated on <?=date('d-M-Y H:i')?></p>
    </div>

    <?php if (!empty($portfolio_filters['category']) || !empty($portfolio_filters['evidence_type']) || !empty($portfolio_filters['tag']) || !empty($portfolio_filters['search'])) { ?>
        <div class="filters">
            <strong>Applied Filters:</strong>
            <?php if (!empty($portfolio_filters['category'])) { ?> Category: <?=$portfolio_filters['category']?>;<?php } ?>
            <?php if (!empty($portfolio_filters['evidence_type'])) { ?> Evidence Type: <?=$portfolio_filters['evidence_type']?>;<?php } ?>
            <?php if (!empty($portfolio_filters['tag'])) { ?> Tag: <?=$portfolio_filters['tag']?>;<?php } ?>
            <?php if (!empty($portfolio_filters['search'])) { ?> Search: <?=$portfolio_filters['search']?>;<?php } ?>
        </div>
    <?php } ?>

    <table class="summary-table">
        <tr>
            <td><strong>Total Entries</strong><br><?=$portfolio_summary['total_items']?></td>
            <td><strong>Categories Used</strong><br><?=$portfolio_summary['category_count']?></td>
            <td><strong>Files Uploaded</strong><br><?=$portfolio_summary['uploads_count']?></td>
        </tr>
    </table>

    <?php if (!empty($portfolio_items)) { ?>
        <?php foreach ($portfolio_items as $item) { ?>
            <div class="entry">
                <h3><?=$item['title']?></h3>
                <p class="small">
                    Date: <?=$item['entry_date']?>
                    <?php if (!empty($item['created_by_name'])) { ?> | Added by <?=$item['created_by_name']?><?php } ?>
                </p>
                <?php if (!empty($item['category'])) { ?><p><span class="label">Category:</span> <?=$item['category']?></p><?php } ?>
                <?php if (!empty($item['evidence_type'])) { ?><p><span class="label">Evidence Type:</span> <?=$item['evidence_type']?></p><?php } ?>
                <?php if (!empty($item['grade'])) { ?><p><span class="label">Grade / Outcome:</span> <?=$item['grade']?></p><?php } ?>
                <?php if (!empty($item['tag_list'])) { ?><p><span class="label">Tags:</span> <?=$item['tag_list']?></p><?php } ?>
                <?php if (!empty($item['summary'])) { ?><p><span class="label">Summary:</span> <?=nl2br(htmlspecialchars($item['summary'], ENT_QUOTES, 'UTF-8'))?></p><?php } ?>
                <?php if (!empty($item['teacher_note'])) { ?><p><span class="label">Teacher Note:</span> <?=nl2br(htmlspecialchars($item['teacher_note'], ENT_QUOTES, 'UTF-8'))?></p><?php } ?>
                <?php if (!empty($item['student_reflection'])) { ?><p><span class="label">Student Reflection:</span> <?=nl2br(htmlspecialchars($item['student_reflection'], ENT_QUOTES, 'UTF-8'))?></p><?php } ?>
                <?php if (!empty($item['file_name'])) { ?><p><span class="label">Attached File:</span> <?=$item['file_name']?></p><?php } ?>
            </div>
        <?php } ?>
    <?php } else { ?>
        <p>No ePortfolio entries found for this export.</p>
    <?php } ?>
</body>
</html>
