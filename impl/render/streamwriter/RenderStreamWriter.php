<?php
/**
 * Determines where to writer the rendered component
 */
interface RenderStreamWriter
{
      public function renderToStream(MarkupParser $markupParser,$content);
}
