# -*- coding: utf-8 -*-

# Define here the models for your scraped items
#
# See documentation in:
# http://doc.scrapy.org/en/latest/topics/items.html

import scrapy

# class TutorialItem(scrapy.Item):
#     title=scrapy.Field()
#     link_from_am=scrapy.Field()
#     image_src=scrapy.Field()
#     price_from_am=scrapy.Field()
#     color = scrapy.Field()
#     internal = scrapy.Field()
    
    		

#for MobileCrawler.py
class TutorialItem(scrapy.Item):
   title = scrapy.Field()
   price_from_fk = scrapy.Field()
   image_src = scrapy.Field()
   link_from_fk = scrapy.Field()
   brand = scrapy.Field()
   color = scrapy.Field()
   os = scrapy.Field()
   ram = scrapy.Field()
   internal = scrapy.Field()	
    
  
  # fields of crawler.py
    #included_software = scrapy.Field()
    #ram = scrapy.Field()
    
    #part_number = scrapy.Field()
    #model_id = scrapy.Field()
    #ram_type = scrapy.Field()
   
