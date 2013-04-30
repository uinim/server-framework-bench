class Spot < ActiveRecord::Base
  # attr_accessible :title, :body
  set_table_name :spot
  set_primary_key :id
end
