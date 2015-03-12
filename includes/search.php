<section id = "search"<?php if(isset($isLogged) && !$isLogged){ ?> style="display:none;"<?php } ?>>
	<div class = "verticalCenter"></div>
	<div id = "searchBox" class = "box">
		<div id = "searchToolsContainer">
			<div id = "searchToolsSubContainer">
				<div id = "searchToolsHeader">Options</div>
				Search Options go here (i.e. sort, filter by employee type)
				<div id = "dialogButtons">
					<input id = "users" class="sideBarButton button" type = "button" value="Users"></input>
					<input id = "reports" class="sideBarButton button" type = "button" value="Reports"></input>
				</div>
			</div>
		</div>
		<div id = "searchContainer">
			<div id = "searchHead">
				<input id = "searchText" placeholder = "Search" type = "text"></input>
				<img id = "searchIcon" src="images/searchIcon.png"/>
			</div>
			<div id = "searchResults">
				Search Results go here
			</div>
		</div>
	</div>
</section>