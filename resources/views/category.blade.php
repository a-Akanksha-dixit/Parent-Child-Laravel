<!-- resources/views/categories.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Categories</title>
    <style>
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .category-select {
            width: 100%;
            padding: 10px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .selected-paths {
            margin-bottom: 20px;
        }
        .selected-paths label {
            display: block;
            margin-bottom: 5px;
        }
        .btn-clear {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Categories</h1>
        <div>
            <label for="parentCategories">Select a parent category:</label>
            <select name="parentCategories" id="parentCategories" class="category-select">
                <option value="">-- Select --</option>
                @foreach ($parentCategories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="selected-paths" id="selectedPaths"></div>

        <button id="clearSelection" class="btn-clear">Clear Selection</button>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const parentCategoriesSelect = document.getElementById('parentCategories');
            const selectedPathsDiv = document.getElementById('selectedPaths');
            const clearSelectionButton = document.getElementById('clearSelection');

            // Event listener for parent category selection change
            parentCategoriesSelect.addEventListener('change', function() {
                const parentId = this.value;

                // Clear previous selections
                selectedPathsDiv.innerHTML = '';

                if (parentId !== '') {
                    console.log('Fetching categories for parent ID:', parentId);
                    fetchCategories(parentId);
                }
            });

            // Event listener for clear selection button click
            clearSelectionButton.addEventListener('click', function() {
                // Clear selected paths
                selectedPathsDiv.innerHTML = '';
                location.reload();
            });

            function fetchCategories(parentId) {
                // Fetch categories with selected parent_id
                fetch(`/api/categories/${parentId}`)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Failed to fetch categories');
                        }
                        return response.json();
                    })
                    .then(data => {
                        console.log('Categories data:', data);
                        // Clear existing options in the dropdown menu
                        parentCategoriesSelect.innerHTML = '';
                        data.forEach(category => {
                            // Display the selected path with a label
                            const label = document.createElement('label');
                            label.textContent = category.path;
                            selectedPathsDiv.appendChild(label);
                            // If the category is a parent and has subcategories
                            if (category.is_parent) {
                                // Create a new option element for each subcategory
                                const option = document.createElement('option');
                                option.value = category.id;
                                option.textContent = category.name;
                                parentCategoriesSelect.appendChild(option);
                            }
                        });
                        
                    })
                    .catch(error => console.error('Error fetching categories:', error));
            }
        });
    </script>
</body>
</html>
