<?php

if (
	array_key_exists('first_name', $_POST) &&
	!preg_match('/^\s*$/', $_POST['first_name'])
)
{
	if (
		array_key_exists('last_name', $_POST) &&
		!preg_match('/^\s*$/', $_POST['last_name'])
	)
	{
		if (
			array_key_exists('phone_ac', $_POST) &&
			array_key_exists('phone_end', $_POST) &&
			array_key_exists('phone_mid', $_POST) &&
			preg_match('/^\d{3}$/', $_POST['phone_ac']) &&
			preg_match('/^\d{4}$/', $_POST['phone_end']) &&
			preg_match('/^\d{3}$/', $_POST['phone_mid'])
		)
		{
			if (
				array_key_exists('email', $_POST) &&
				preg_match('/^.+\@.+\..{2,8}$/', $_POST['email'])
			)
			{
				if (array_key_exists('unsecured_debt', $_POST))
				{
					$_POST['first_name'] = str_replace(Array("\n", "\r"), '', $_POST['first_name']);
					$_POST['last_name'] = str_replace(Array("\n", "\r"), '', $_POST['last_name']);
					$_POST['email'] = str_replace(Array("\n", "\r"), '', $_POST['email']);
					mail(
						'leads@4pillarscalgary.ca',
						$_POST['first_name'] . ' ' . $_POST['last_name'] . ' is requesting a debt assessment.',
						'Name: ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . "\r\n" .
						'E-Mail: ' . $_POST['email'] . "\r\n" .
						'Phone: ' . $_POST['phone_ac'] . '-' . $_POST['phone_mid'] . '-' . $_POST['phone_end'] . "\r\n\r\n" .
						"Unsecured Debt:\r\n" .
						$_POST['unsecured_debt'],
						'To: Leads <leads@4pillarscalgary.ca>' . "\r\n" .
						'From: ' . $_POST['first_name'] . ' ' . $_POST['last_name'] . ' <' . $_POST['email'] . '>' . "\r\n"
					);
					header('Location: index.html?sent');
				}
				else
					header('Location: index.html?error=5');
			}
			else
				header('Location: index.html?error=4');
		}
		else
			header('Location: index.html?error=3');
	}
	else
		header('Location: index.html?error=2');
}
else
	header('Location: index.html?error=1');
?>