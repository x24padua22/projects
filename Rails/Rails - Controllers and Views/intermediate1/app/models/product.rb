class Product < ActiveRecord::Base
  belongs_to :category
  attr_accessible :description, :name, :pricing, :category_id

  validates :description, :name, :pricing, :presence => true
end
