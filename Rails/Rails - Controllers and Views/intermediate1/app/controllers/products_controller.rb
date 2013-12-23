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
      render "index"
    else
      flash[:errors] = @product.errors.full_messages
      redirect_to new_product_path
    end
  end

  def update
    @product = Product.find(params[:id])

    if @product.update_attributes(params[:product])
      @products = Product.all
      flash[:notice] = "Product information has been updated."
      redirect_to product_path
    else
      flash[:errors] = @product.errors.full_messages
      redirect_to edit_product_path
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
    render "index"
  end
end
