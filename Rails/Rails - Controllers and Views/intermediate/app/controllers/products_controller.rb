class ProductsController < ApplicationController
  def index
    @products = Product.all
  end

  def show
    @product = Product.find(params[:id])
    @category = Product.find(params[:id]).category
  end

  def new
    @product = Product.new
  end

  def edit
    @product = Product.find(params[:id])
  end

  def create
    @product = Product.new(params[:product])

    if @product.save
      @products = Product.all
      flash[:notice] = "You have successfully added a new product!"
      render action: "index"
    else
      render action: "new"
    end
  end

  def update
    @product = Product.find(params[:id])

    if @product.update_attributes(params[:product])
      @products = Product.all
      flash[:notice] = "Product information has been updated."
      render action: "index"
    else
      render action: "edit"
    end
  end

  def destroy
    @product = Product.find(params[:id])
    
    if @product.destroy
      flash[:notice] = "Product has been deleted."
    else
      flash[:notice] = "Sorry, the product was not deleted."
    end

    @products = Product.all
    render action: "index"
  end
end
