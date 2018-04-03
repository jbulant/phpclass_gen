#!/bin/sh
if [[ $1 == "" ]]
then
	echo "Please specify a path or -remove"
	exit
fi
if [[ ( ! -d "$1" ) && $1 != "-remove" && $1 != "-update" ]]
then
	echo "Directory doesn't exist";
	exit
fi
if [[ $1 == "-remove" ]]
then
	grep "phpcg" ~/.bashrc 2>/dev/null >/dev/null
	find1=$?;
	grep "phpcg" ~/.zshrc 2>/dev/null >/dev/null
	find2=$?;
	if [[ ( $find2 = 0 ) || ( $find1 = 0 )]]
	then
		grep "phpcg" ~/.zshrc 2>/dev/null >/dev/null
		find=$?;
		if [[ ( -f ~/.bashrc ) && ( $find = 0 ) ]]
		then
			path=`grep "phpcg" ~/.bashrc | head -n1 | cut -d"'" -f2 | sed -e "s/php -f //" | rev | cut -d'/' -f2- | rev`;
			grep -vwE "(phpcg)" ~/.bashrc > ~/.bashrcnew
			rm -rf ~/.bashrc 2>/dev/null >/dev/null
			mv ~/.bashrcnew ~/.bashrc 2>/dev/null >/dev/null
			source ~/.bashrc 2>/dev/null >/dev/null
			echo "Phpcg uninstall ok"
		fi
		grep "phpcg" ~/.zshrc 2>/dev/null >/dev/null
		find=$?;
		if [[ ( -f ~/.zshrc ) && ( $find = 0 ) ]]
		then
			path=`grep "phpcg" ~/.zshrc | head -n1 | cut -d"'" -f2 | sed -e "s/php -f //" | rev | cut -d'/' -f2- | rev`;
			grep -vwE "(phpcg)" ~/.zshrc > ~/.zshrcnew
			rm -rf ~/.zshrc 2>/dev/null >/dev/null
			mv ~/.zshrcnew ~/.zshrc 2>/dev/null >/dev/null
			source ~/.zshrc 2>/dev/null >/dev/null
			echo "Phpcg uninstall ok"
		fi
		rm -rf $path/phpclass_gen.php 2>/dev/null >/dev/null
		rm -rf $path/ClassName.class.php 2>/dev/null >/dev/null
	else
		echo "Phpcg is not installed"
	fi
elif [[ $1 == "-update" ]]
then
	echo "updating ..."
	cd `dirname "$0" | rev | cut -d"." -f2- | rev`
	git pull
else
	grep "phpcg" ~/.bashrc 2>/dev/null >/dev/null
	ret=$?;
	if [[ ( -f ~/.bashrc ) && ( $ret == 1 ) ]]
	then
		echo "alias phpcg='$1/php -f phpclass_gen.php'" >> ~/.bashrc
		cp phpclass_gen.php $1 2>/dev/null >/dev/null
		cp ClassName.class.php $1 2>/dev/null >/dev/null
		source ~/.bashrc 2>/dev/null >/dev/null
		echo "Install Complete"
	fi
	grep "phpcg" ~/.zshrc 2>/dev/null >/dev/null
	ret=$?;
	if [[ ( -f ~/.zshrc ) && ( $ret == 1 ) ]]
	then
		echo "alias phpcg='$1/php -f phpclass_gen.php'" >> ~/.zshrc
		cp phpclass_gen.php $1 2>/dev/null >/dev/null
		cp ClassName.class.php $1 2>/dev/null >/dev/null
		source ~/.zshrc 2>/dev/null >/dev/null
		echo "Install Complete"
	fi
	if [[ $ret == 0 ]]
	then
		echo "Phpcg Already install"
	fi
fi
