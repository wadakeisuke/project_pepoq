<?php
/**
 * パラメータをサニタイズ
 * @param int $value
 * @return int
 */
function h($value)
{
	return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
}
