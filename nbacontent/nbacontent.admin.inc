<?php

/**
 * Implements hook_form().
 */
function nbacontent_config_form($form, &$form_state)
{
    return system_settings_form($form);
}