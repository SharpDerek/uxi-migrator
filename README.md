# uxi-migration-theme

## Goal for this theme/plugin:
Make it possible to migrate a UXI site with the click of a button.

### What that looks like:
* [x] Import UXI Styling
  * [x] Stylesheets on UXI copied into theme `/css` directory
  * [x] Asset URLs in Stylesheets made into relative paths
    * [x] Images referenced in UXI stylesheets migrated into theme `/img` directory
* [x] Import UXI Fonts
  * [x] All font files referenced in UXI stylesheets copied into theme `/fonts/site` directory
* [x] ACF Flexible Content generated using UXI page content
* [ ] Import UXI Header Layouts
  * [ ] Post type registered for Header Layouts (to allow for multiple Header Templates)
    * [ ] ACF Flexible Content rows assigned to appropriate post type for current page/post
* [ ] Import UXI Footer Layouts
  * [ ] Post type registered for Footer Layouts (to allow for multiple Footer Templates)
    * [ ] ACF Flexible Content rows assigned to appropriate post type for current page/post
* [ ] Import UXI Template Layouts
  * [ ] Post type registered for Template Layouts (to allow for multiple Page Templates)
    * [ ] ACF Flexible Content rows assigned to appropriate post type for current page/post
* [ ] Import UXI Mobile Header
  * [x] Content brought in for Mobile Header
  * [ ] Content brought in for Left Mobile Drawer
  * [ ] Content brought in for Right Mobile Drawer
* [ ] Transition Functions
  * [ ] All page URLs changed into relative ones
  * [ ] All asset URLs changed to relative ones/media folder ones
  
### Ideal Migration Workflow
1) Spin up site on dev server
2) Install theme and plugin
3) Install Wordpress XML Importer
4) Upload UXI XML file to importer
5) Open the Migrator tool
6) Type in the homepage URL for the UXI site
7) Click "Run Migration"
8) QC all pages on site
9) Done

### Sites to test
* [ ] https://www.drcohen.ca
* [ ] https://www.krazykarlspizza.com
* [ ] https://www.bestglendaledentist.com
