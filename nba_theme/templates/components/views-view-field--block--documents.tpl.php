<?php

    if ($row && isset($row->field_documents) && count($row->field_documents) > 0) {
        foreach ($row->field_documents as $delta => $item) {
            echo render($item['rendered']);
        }
    }