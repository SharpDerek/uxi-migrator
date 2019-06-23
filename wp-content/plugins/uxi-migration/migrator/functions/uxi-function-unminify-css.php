<?php

function uxi_unminify_css($css) {
	$css = str_replace(';',";\n",
		str_replace('{'," {\n",
			str_replace('}',"\n}\n\n",
				str_replace('*/',"*/\n",
					$css
				)
			)
		)
	);
	return $css;
}
								