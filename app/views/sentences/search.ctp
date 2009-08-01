<?php
if(isset($query)){
	$query = stripslashes($query);
	
	echo '<h2>Search : ' . htmlentities($query, ENT_QUOTES, 'UTF-8') . ', <em>' . $resultsInfo['sentencesCount'] . ' result(s)</em></h2>';
	
	if(isset($mostFrequentWords) AND count($mostFrequentWords) > 0 AND $resultsInfo['sentencesCount'] > 0){
		echo '<div id="mostFrequentWords">';
		echo '<div>';
		__('Most frequent words in the target language');
		echo '</div>';
		foreach($mostFrequentWords as $word){
			echo '<span style="font-size:'.$word['fontSize'].'%" title="'.$word['details'].'">';
			echo $word['word'];
			echo '</span> ';
		}
		echo '</div>';
	}
	
	if(isset($results)){		
		$pagination->displaySearchPagination($resultsInfo['pagesCount'], $resultsInfo['currentPage'], $query, $from, $to);
		
		$i = 0;
		
		foreach($results as $sentence){
			echo '<div class="sentences_set search">';
			// sentence menu (translate, edit, comment, etc)
			$specialOptions[$i]['belongsTo'] = $sentence['User']['username']; // TODO set up a better mechanism
			$sentences->displayMenu($sentence['Sentence']['id'], $sentence['Sentence']['lang'], $specialOptions[$i], $scores[$i]);
			
			// sentence and translations
			$sentence['User']['canEdit'] = $specialOptions[$i]['canEdit']; // TODO set up a better mechanism
			$sentences->displayGroup($sentence['Sentence'], $sentence['Translation'], $sentence['User']);
			echo '</div>';
			
			$i++;
		}
		
		$pagination->displaySearchPagination($resultsInfo['pagesCount'], $resultsInfo['currentPage'], $query, $from, $to);
		
	}else{
		__('No results for this search');
	}
}
?>