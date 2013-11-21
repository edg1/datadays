{if $options->sliderEnable == 1}
	{if $options->sliderAliases != 'null'}
		{if isset($options->sliderAlternativeMobile) && $options->sliderAlternativeMobile != ''}
		<div class="slider-alternative mobile" style="display: none">
			<img src="{$options->sliderAlternativeMobile}" alt="alternative" />
		</div>
		{/if}
		{if isset($options->sliderAlternativeTablet) && $options->sliderAlternativeTablet != ''}
		<div class="slider-alternative tablet" style="display: none">
			<img src="{$options->sliderAlternativeTablet}" alt="alternative" />
		</div>
		{/if}
		{if function_exists('putRevSlider')}
			{putRevSlider($options->sliderAliases)}
		{/if}
	{/if}
{/if}