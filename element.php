<?php
	/*
		Usage:
			1.
			<div>hello world</div>
			
			$div = e("div")->add(
				text("hello world")
			)

			echo $div;

			2.
			<table border="1">
				<tr>
					<td></td>
				</tr>
				<tr>
					<td></td>
				</tr>
			</table>

			$table = e("table")->
				add(e("tr")->add(
					e("td")
				))->
				add(e("tr")->add(
					e("td")
				));

			echo $table;

	*/

	function lines($text){
		$lines = array();
		$buf = "";
		for($i = 0; $i < strlen($text); $i++){
			if($text[$i] == "\n"){
				array_push($lines, $buf."\n");
				$buf = "";
			} else {
				$buf .= $text[$i];
			}
		}
		if($buf != ""){
			array_push($lines, $buf);
		}
		return $lines;
	}

	function indent($tag){
		if($tag instanceof Element){
			$tab = $tag->__toString();
		}
		$lines = lines($tag);
		$out = "";
		for($i = 0; $i < count($lines); $i++){
			$out .= "\t".$lines[$i];
		}
		return $out;
	}

	class Element{
		private $tagName;
		private $inners = array();
		private $attrs = array();
		private $indentCnt = 0;

		function __construct($name){
			$this->tagName = $name;
		}

		function __toString(){
			$out = "<$this->tagName ";
			$as = array_keys($this->attrs);
			foreach($as as $a){
				$out .= "$a=\"{$this->attrs[$a]}\" ";
			}
			$out .=">\n";
			foreach($this->inners as $inner){
				$out .= $inner->indented();
			}
			$out .= "</$this->tagName>\n";

			for($i = 0; $i < $this->indentCnt; $i++){
				$out = indent($out); 
			}
			return $out;
		}

		function add($el){
			array_push($this->inners, $el);
			return $this;
		}

		function attr($a, $val){
			$this->attrs[$a] = $val;
			return $this;
		}

		function indented(){
			$this->indentCnt++;
			return $this;
		}


	}

	class Text{
		private $text;

		function __construct($text){
			$this->text = $text;
		}

		function __toString(){
			return $this->text."\n";
		}

		function indented(){
			return "\t{$this->text}\n";
		}
	}
	function e($tagName){
		return new Element($tagName);
	}

	function text($text){
		return new Text($text);
	}

?>