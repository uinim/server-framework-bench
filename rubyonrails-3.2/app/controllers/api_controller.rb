require 'pp'

class ApiController < ApplicationController
  def index

  	# データ取得
  	result = Spot.find(
  		:all,
  		:joins => "LEFT JOIN `prefecture` ON spot.prefecture_id = prefecture.id",
  		:select => "spot.*, prefecture.name AS prefecture_name",
  		:order => "spot.id DESC",
  		:limit => 10
  	)

  	pp(result);

  	# jsonの返却
    render :json => result
  end
end
