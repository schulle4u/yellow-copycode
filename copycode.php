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
    
    // Handle page extra data
    public function onParsePageExtra($page, $name) {
        $output = null;
        if ($name=="header") {
            $assetLocation = $this->yellow->system->get("coreServerBase").$this->yellow->system->get("coreAssetLocation");
            $output .= "<script type=\"text/javascript\" defer=\"defer\" src=\"{$assetLocation}copycode.js\"></script>\n";
        }
        return $output;
    }
    // Handle page output data
    public function onParsePageOutput($page, $text) {
        $output = null;
        if ($text)  {
            $outputNew = "</pre>\n";
            $outputNew .= "<div class=\"copycode\"><button class=\"copycode-btn\" data-copycodeCopied=\"".$this->yellow->language->getTextHtml("copycodeButtonCopied")."\" aria-label=\"".$this->yellow->language->getTextHtml("copycodeButton")."\">";
            $outputNew .= "<span class=\"copycode-btn-text\">".$this->yellow->language->getTextHtml("copycodeButton")."</span><span class=\"copycode-sr-only\" aria-live=\"polite\"></span>";
            $outputNew .= "</button></div>\n";
            $output = preg_replace("/<\/pre>/", $outputNew, $text);
        }
        return $output;
    }
}
