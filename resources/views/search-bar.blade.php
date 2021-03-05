<div class="card my-4">
    <h5 class="card-header">Search</h5>
    <form class="card-body" action={{route('establishments.search')}} method="GET" role="search">
        {{ csrf_field() }}
        <div class="row">
            <div class="col-4">
                <label>Search location</label>
                <input type="text" class="form-control" value="{{ old('q', $key ?? "") }}" placeholder="Search place name or post code." name="q">
            </div>
            <div class="col-4">
                <label>Sort by</label>
                <select class="form-control" size="width:20%" id="sortBy" name="sort_by" required>
                    <option value="distance" {{ old('sort_by',$sort_by ?? "")=='distance' ? 'selected' : ''}}>Distance</option>
                    <option value="a-z" {{ old('sort_by',$sort_by ?? "")=='a-z' ? 'selected' : ''}}>A-Z</option>
                    <option value="z-a" {{ old('sort_by',$sort_by ?? "")=='z-a' ? 'selected' : ''}}>Z-A</option>
                    <option value="rating" {{ old('sort_by',$sort_by ?? "")=='rating' ? 'selected' : ''}}>Highest Rating</option>
                </select>
            </div>
            <div class="col-4">
                <label>Within</label>
                <select class="form-control" size="width:100px height:10px" id="radius" name="radius" required>
                    <option value=0.5 {{ old('radius',$radius ?? "")=='0.5' ? 'selected' : ''}}>0.5km</option>
                    <option value=1 {{ old('radius',$radius ?? "")=='1' ? 'selected' : ''}}>1km</option>
                    <option value=2 {{ old('radius',$radius ?? "")=='2' ? 'selected' : ''}}>2km</option>
                    <option value=3 {{ old('radius',$radius ?? "")=='3' ? 'selected' : ''}}>3km</option>
                    <option value=4 {{ old('radius',$radius ?? "")=='4' ? 'selected' : ''}}>4km</option>
                    <option value=5 {{ old('radius',$radius ?? "")=='5' ? 'selected' : ''}}>5km</option>
                    <option value=10 {{ old('radius',$radius ?? "")=='10' ? 'selected' : ''}}>10km</option>
                </select>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <span class="input-group-btn">
                    <button class="btn btn-secondary" type="submit">Go!</button>
                    @error('q')
                        <div class="alert alert-danger">A search term is required</div>
                    @enderror
                </span>
            </div>
        </div>
    </form>
</div>
