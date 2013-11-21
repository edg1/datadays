{if $options->productsDisplay}
	{var $wProducts = $site->create('wproduct', $options->productsCategory)}
	{if $wProducts}
	<section class="section tabs-section">
		<div class="tabs-container onecolumn wrapper entry-content">
			<h2>{$options->productsTitle}</h2>
			<div class="tabs-buttons sc-column one-fourth">				
				<ul class="sc-list style2 line">
				{foreach $wProducts as $wProduct}
					{if $wProduct->options->productVisible}
					<li class="tab {if $iterator->first}active{/if}" data-tab="{$iterator->getCounter()}" style="cursor: pointer">{$wProduct->title}</li>
					{/if}
				{/foreach}
				</ul>
			</div>
			{foreach $wProducts as $wProduct}
				{if $wProduct->options->productVisible}
					{if $iterator->getCounter() <= 1}
					<div class="tabs-content sc-column sc-column-last three-fourth-last tab-{$iterator->getCounter()}">
						<!-- <h2>{$options->productsTitle}</h2> -->
						<div>
							{!$wProduct->options->productDescription}
						</div>
					</div>
					{else}
					<div class="tabs-content sc-column sc-column-last three-fourth-last tab-{$iterator->getCounter()}" style="display: none">
						<!-- <h2>{$options->productsTitle}</h2> -->
						<div>
							{!$wProduct->options->productDescription}
						</div>
					</div>
					{/if}
				{/if}
			{/foreach}
			<div class="clearing"></div>
		</div>
	</section>
	{/if}
{/if}