# Gardeners Planting System 1.0

This is the first edition of the Gardener's Planting System. It was written in about 2018, if not earlier, and represents stable, flat file development for really simple Web pages.

After the application is considered robust, for the platform on which it was designed, all that remains is to add data to the files as the opportunity presents itself.

Most of the description of the site has been included in its pages, instead of in the README file.

It has been replaced with the edition that uses a database for its information, instead of this flat file system. However, the web page is still usable.

All of the .csv files contain the same type of information. It was easier to split the data into separate files based on the value of two variables, for the flat-file edition.

Consequently, the six files are identical, with the exception of the following values.
Annual plants must be re-purchased annually, whereas Perennials come back every year.  Biennials live for two - three years before requiring replacement.
- Annuals    - Perennial = "A"
- Biennials  - Perennial = "B"
- Perennials - Perennial = "P"

The initial classification was pretty simple.  For the most part, everybody knows what a tree is.  Likewise, if a plant is considered consumable by humans, it is edible; otherwise, the default class is "flower".
- Edibles - EFT ="E"
- Flowers - EFT ="F"
- Trees   - EFT ="T"

The first column in the spreadsheet acts as an index to assist in displaying content across multiple tables.
