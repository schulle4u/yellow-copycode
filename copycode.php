<?php
// Copycode extension, https://github.com/schulle4u/yellow-copycode

class YellowCopycode {
    const VERSION = "0.9.0";
    public $yellow;         // access to API
    
    // Handle initialisation
    public function onLoad($yellow) {
        $this->yellow = $yellow;
        $this->yellow->language->setDefaults(array(
            "Language: en",
            "CopycodeDescription: Copy code blocks to clipboard.",
            "CopycodeButton: Copy code",
            "CopycodeButtonCopied: Code copied!",
            "Language: de",
            "CopycodeDescription: Code-Blöcke in Zwischenablage kopieren.",
            "CopycodeButton: Code kopieren",
            "CopycodeButtonCopied: Code kopiert!",
            "Language: sv",
            "CopycodeDescription: Kopiera kodblock till klippbordet.",
            "CopycodeButton: Kopiera kod",
            "CopycodeButtonCopied: Kod kopierad!"));
    }
    
    // Handle page content element
    public function onParseContentElement($page, $name, $text, $attributes, $type) {
        $output = null;
        if ($name=="copycode" && ($type=="block" || $type=="inline")) {
            $output = "<div class=\"".htmlspecialchars($name)."\"><button class=\"".htmlspecialchars($name)."-btn\" data-copycodeCopied=\"".$this->yellow->language->getTextHtml("copycodeButtonCopied")."\" aria-label=\"".$this->yellow->language->getTextHtml("copycodeButton")."\">";
            $output .= "<span class=\"".htmlspecialchars($name)."-btn-text\">".$this->yellow->language->getTextHtml("copycodeButton")."</span><span class=\"".htmlspecialchars($name)."-sr-only\" aria-live=\"polite\"></span>";
            $output .= "</button></div>\n";
        }
        return $output;
    }
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $assetLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreAssetLocation");
            $output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$assetLocation}copycode.js\"></script>\n";
        }
        return $output;
    }
}
