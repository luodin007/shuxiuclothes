<?php
	class PaginationWidget extends Widget
	{
		public function render($data)
		{
			$content = $this->renderFile('Pagination',$data);
			return $content;
		}
	}