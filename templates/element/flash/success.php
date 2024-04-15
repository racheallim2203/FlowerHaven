<?php
/**
 * @var \App\View\AppView $this
 * @var array $params
 * @var string $message
 */

if (!isset($params['escape']) || $params['escape'] !== false) {
    $message = h($message);
}
?>
<div style="background-color: #2ca02c; color: white; padding: 10px;" onclick="this.classList.add('hidden')"><?= $message ?></div>
