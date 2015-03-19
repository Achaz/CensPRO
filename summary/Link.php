<?php
	class Link{
		private $title, $url;
		
		public function Link($title, $url){
			$this->title = $title;
			$this->url = $url;
		}
		
		public function getURL(){
			return $this->url;
		}
		
		public function getTitle(){
			return $this->title;
		}
		
	}
?>